#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE lobo_test;"
    psql -U postgres -c "CREATE USER lobo PASSWORD 'lobo' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists lobo
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists lobo_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists lobo
    sudo -u postgres psql -c "CREATE USER lobo PASSWORD 'lobo' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O lobo lobo
    sudo -u postgres createdb -O lobo lobo_test
    LINE="localhost:5432:*:lobo:lobo"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
