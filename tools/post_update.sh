#!/bin/bash

if [[ -z $release_date ]]; then
    echo "post_update.sh can't be run directly - please run tupdate instead"
    exit 1
fi

new_tag=$(git describe --tags)

if [[ "$release_date" -lt "20211112" ]]; then
    # Don't do anything for now.
    # In the future, we can use steps like this to fix things automatically where necessary.
    echo "" >> /dev/null
fi

echo_important "\nPulling the latest container images - this could take a few minutes...\n"
$project_path/bin/tpull

if [[ -f "$project_path/tools/.stopped_services" ]]; then
    echo_important "\nStarting your containers again...\n"
    xargs $project_path/bin/tup < "$project_path/tools/.stopped_services"
fi

echo_success "\nSuccessfully updated to $new_tag!"
echo_success "View the release notes here: https://github.com/totara/totara-docker-dev/releases"

if [[ -f "$project_path/tools/.stopped_services" ]]; then
    rm -f "$project_path/tools/.stopped_services"
else
    echo "Note: You will need to start your containers again with the tup command"
fi

