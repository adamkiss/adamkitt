#!/usr/bin/env zsh
# shellcheck shell=bash

start () { #: prepare stuff and watch
	npm start --loglevel=silent
}
prod () { #: run through the whole pipeline
	npm run prod --loglevel=silent
}
install () { #: Install all dependencies
	composer install -no && pnpm i
}

fonts () { #: subset fonts
	setopt extended_glob

	assets='public/assets'

	rm -r $assets/fonts 2>/dev/null
	mkdir -p $assets/fonts 2>/dev/null
	cp assets/fonts-raw/* ./$assets/fonts/

	wait

	for f in $assets/fonts/*; do
		glyphhanger --formats=woff2 --subset="$(dirname "$0")/$f" --css --LATIN --whitelist="ÁÄÉÍÓÔÚÝáäéíóôúýČĎŇŠŽčďňšžŤťŔŕĽľĹ" --string --json
	done


	wait
	rm ./$assets/fonts/^*subset.*
}

#
# BOILERPLATE
#
r='./r.sh'
NAME='tpl-project-name'

about () { #: show help & commands
    echo "$NAME script runner"
    echo "Commands:"
    sed -nr 's/^(.*) \(\).* #: (.*)$/  \1\t\2/p' $r | expand -20
}

if [[ $# -gt 0 ]]; then
	command="$1"
	shift 1
	if type "$command" 2>/dev/null | grep -q 'function'; then
		$command "$@"
	else
		about
		echo "No command '$command'."
	fi;
else
    # about
	start
fi
