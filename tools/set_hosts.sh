#!/bin/bash

script_path=$( cd "$(dirname $0)" || exit; pwd -P )
project_path=$( cd "$script_path" && cd ..; pwd -P )
set -a; source "$project_path/.env"; set +a

source "$project_path/tools/shell_utils.sh"

echo_warning "Note: This script is deprecated and will be removed in a future version.\nPlease instead visit your sites by adding .localhost to the domain.\nFor example: http://integration.totara83.localhost"

# If this is being run inside WSL, then we need to modify the /etc/hosts file on Windows
if [[ -f "/mnt/c/Windows/System32/drivers/etc/hosts" ]]; then
  hosts_file="/mnt/c/Windows/System32/drivers/etc/hosts"
else
  hosts_file="/etc/hosts"
fi

echo "Sudo access is required to update the hosts file"

if ! sudo touch "$hosts_file" &> /dev/null; then
  echo_error "Sudo access denied or the $hosts_file is not writable!"
  exit
fi

# Create a backup of the existing hosts file in case something goes wrong
date=$(date -Idate)
backup_path="$hosts_file.pre-$date.backup"
if ! sudo test -r "$backup_path" -a -w "$backup_path"; then
  backup_path="$HOME/hosts.pre-$date.backup"
fi
sudo rm -f "$backup_path"
sudo cp "$hosts_file" "$backup_path"
echo_info "Backed up $(underline_text $hosts_file) to $(underline_text $backup_path)"

# Remove existing docker-dev hosts entries
sudo sh -c "sed '/totara-docker-dev/d' $hosts_file > /tmp/hosts"
sudo sh -c "sed -E '/totara[0-9]{2}/d' /tmp/hosts > $hosts_file"
sudo rm "/tmp/hosts"

# Shouldn't need to change this
host_ip="127.0.0.1"

# Get all the possible php hosts from the docker compose yml file
php_versions=($(cat "$project_path/compose/php.yml" | sed -E -n 's/.*\php-([0-9]).([0-9])[^:]*:/\1\2/p' | uniq | sort))

# Get the sub sites that we should also add host entries for
sites=($(find "$LOCAL_SRC" -mindepth 2 -maxdepth 2 -name "version.php" -type f -exec dirname {} \; | sort | xargs -n 1 basename))

hosts=""

for php_version in "${php_versions[@]}"; do
  hosts+="\n${host_ip} totara${php_version} totara${php_version}.behat totara${php_version}.debug"
done

# Sub site hosts
for site in "${sites[@]}"; do
  for php_version in "${php_versions[@]}"; do
    hosts+="\n${host_ip} ${site}.totara${php_version} ${site}.totara${php_version}.behat ${site}.totara${php_version}.debug"
  done
done

hosts="\n# totara-docker-dev start$hosts\n# totara-docker-dev end\n"

# Add the hosts
sudo -- sh -c -e "echo '$hosts' >> $hosts_file"

echo_success "Successfully updated $(echo_underline $hosts_file) with docker-dev hosts"
if [ -n "$sites" ]; then
  echo "Hosts have been added for the following sites: ${sites[@]}"
fi
