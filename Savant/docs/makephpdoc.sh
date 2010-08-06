#!/bin/bash
TITLE="Savant"

PACKAGE="Savant"

SOURCE=/home/broncko/Documents/projects/Savant/lib/Savant

TARGET=/home/broncko/Documents/projects/Savant/docs/phpdoc/

OUTPUTFORMAT=HTML

CONVERTER=Smarty

TEMPLATE=default

phpdoc -d "$SOURCE" -t "$TARGET" -ti "$TITLE" -dn "$PACKAGE" -o $OUTPUTFORMAT:$CONVERTER:$TEMPLATE
