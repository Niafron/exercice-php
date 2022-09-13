#!/bin/bash
set -e

PREFIX_MENTION="\e[1m\e[42m==>\e[0m"

echo -e "$PREFIX_MENTION Create .env file."
rm -f .env
touch .env
DIST_VARS=$(awk -F "=" '/^[A-Z]/ { print $1; }' .env.dist)
for var_name in $DIST_VARS; do
    value=$(awk -F "=" "/^$var_name=/ { print $2; }" .env.dist)
    if [ "$(cat .env | grep "^$var_name="|wc -l)" != "1" ]; then
        echo -e "$PREFIX_MENTION Var '$var_name' present in .env.dist file, not in .env - Adding it."
        echo "$value" >> .env
    fi;
done
