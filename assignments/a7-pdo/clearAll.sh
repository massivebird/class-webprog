#!/usr/bin/env bash

# deletes files and
# clears sql table

TABLE_NAME="a7pdo"

# delete all files, broken??
rm -v "$HOME/public_html/a7-pdo/files/*"
if [ $? -ne 0 ]; then
   printf "%s: ERROR: failed to delete files\n" $0
else
   printf "%s: successfully deleted files\n" $0
fi

# clear sql table
mysql <<< "DELETE FROM $TABLE_NAME"
if [ $? -ne 0 ]; then
   printf "%s: ERROR: failed to clear table\n" $0
else
   printf "%s: successfully cleared table\n" $0
fi
