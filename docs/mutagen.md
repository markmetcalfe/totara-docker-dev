# Mutagen

To speed up performance you can use a sync tool called mutagen. 

This should work on all platforms but is especially relevant for Mac OS and Windows as the performance of mounted volumes on those platforms is really bad. If you are using Linux you can skip this as performance there is pretty good, almost native.

__Mutagen__ is a two-way-sync tool with focus on performance. Read more about it here: https://mutagen.io.

It runs in the background and keeps syncing your files onto a mounted volume inside your docker containers. It's pretty performant and the delay is minimal even if you change a lot of files at once.

To use mutagen first install it. On Mac OS you can use homebrew for that or alternatively download the appropriate release file from https://github.com/havoc-io/mutagen/releases

```bash
brew install havoc-io/mutagen/mutagen
```

**Make sure you have at least version 0.10.0 runnning.**

To have mutagen automatically start up with your machine
```bash
mutagen daemon register
```

Then start the daemon. This is a background process without the sync does not work. If you have registered the daemon with the command above you won't need to do this every time.
```bash
mutagen daemon start
```
To activate the use of mutagen copy the file `.use-mutagen.dist` to `.use-mutagen`.
```bash
cp .use-mutagen.dist .use-mutagen
```

If you then use the commands `tup` and `tdown` as described in the following chapters the correct sync session is automatically created for you.

#### Monitoring

To find out if your sync is working you can use the following command:
```bash
mutagen sync list
```
which shows something like:
```bash
⇒  mutagen sync list
--------------------------------------------------------------------------------
Name: totara
Identifier: ddc06807-2554-47f4-ba8a-230f37c5e577
Labels: None
Alpha:
	URL: /your/local/path/to/totara/src
	Connection state: Connected
Beta:
	URL: docker://totara_sync/var/www/totara/src
		DOCKER_HOST=
		DOCKER_TLS_VERIFY=
		DOCKER_CERT_PATH=
	Connection state: Connected
Status: Watching for changes
--------------------------------------------------------------------------------
```
You can use the session id or any part of the paths to monitor the session, for example:
```bash
mutagen sync monitor totara
```
