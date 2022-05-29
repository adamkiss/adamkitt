#!/bin/zsh

setopt extended_glob

rm ./public/assets/fonts/* 2>/dev/null
mkdir ./public/assets/fonts 2>/dev/null
cp ./assets/fonts-raw/* ./public/assets/fonts/

wait

for f in public/assets/fonts/*; do
	glyphhanger --formats=woff2 --subset="$(dirname "$0")/$f" --css
done

wait
rm ./public/assets/fonts/^*subset.*
