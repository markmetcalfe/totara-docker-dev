#!/bin/bash

script_path=$( cd "$(dirname "$0")" || exit; pwd -P )
project_path=$( cd "$script_path" && cd ..; pwd -P )

set -e
source "$project_path/tools/shell_utils.sh"

old_tag=$(git describe --tags)

export $(grep -E -v '^#' "$project_path/tools/.version" | xargs)


# Actual update steps
echo_important "Updating docker dev to the latest version..."

# Store the list of running services so they can be restarted later
echo_important "Stopping all running containers..."
echo "$(tdocker ps --services --status running | xargs)" > "$project_path/tools/.stopped_services"
"$project_path"/bin/tdown

# Rebase on the latest master in case there are any local commits
echo_important "Pulling the latest code..."
git pull origin master --rebase

source $project_path/tools/post_update.sh
