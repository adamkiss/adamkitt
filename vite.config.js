import { defineConfig, loadEnv, mergeConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import picomatch from 'picomatch';
import path from 'path';
import fs from 'fs';

export default defineConfig({
	plugins: [
		kirby({
			input: [
				'assets/main.js',
				'assets/main.css',
			],
			reload: [
				'site/**',
			],
			moveManifest: 'assets/manifest.json'
		}),
		tailwindcss(),
	],
	resolve: {
		alias: {
			// '@fonts': 'resources/fonts',
			// '@media': 'resources/media',
			// '@scripts': 'resources/scripts',
			// '@styles': 'resources/styles',
		},
	},
});

function kirby(options) {
	const root = process.cwd();
	const file = path.resolve('public/vite');

	return {
		name: 'kirby',
		enforce: 'post',
		config(config, { mode }) {
			const env = loadEnv(mode, root, '');

			return mergeConfig({
				publicDir: false,
				build: {
					manifest: 'manifest.json',
					outDir: 'public/assets',
					assetsDir: 'dist',
					rollupOptions: {
						input: options.input,
					}
				},
				server: {
					host: 'localhost',
					cors: {
						origin: [
							/^https?:\/\/(?:(?:[^:]+\.)?localhost|127\.0\.0\.1|\[::1\])(?::\d+)?$/,
							/^https?:\/\/.*\.ddev.site(:\d+)?$/,
							/^https?:\/\/.*\.test(:\d+)?$/,
						]
					},
				}
			}, config);
		},
		configureServer(server) {
			server.httpServer?.once('listening', () => {
				const address = server.httpServer.address();
				const protocol = server.config.server.https ? 'https' : 'http';
				const host = server.config.server.host || address.address || 'localhost';
				const port = server.config.server.port || address.port || 5173;

				fs.writeFileSync(file, `${protocol}://${host}:${port}`);
			});

			process.on('exit', () => {
				if (fs.statSync(file)) {
					fs.unlinkSync(file);
				}
			});

			process.on('SIGINT', () => process.exit());
			process.on('SIGTERM', () => process.exit());
			process.on('SIGHUP', () => process.exit());

			const reload = file => {
				const relative = path.relative(root, file).replace(/\\/g, '/');

				if (picomatch(options.reload)(relative)) {
					console.log(`Reloading: ${relative}`);
					server.ws.send({
						type: 'full-reload',
						path: '*',
					});
				}
			};

			server.watcher.on('add', reload);
			server.watcher.on('change', reload);
		},
		closeBundle() {
			const builtPath = path.resolve('public/assets/manifest.json');
			const targetPath = path.resolve(__dirname, options.moveManifest || 'assets/manifest.json');

			if (fs.existsSync(builtPath)) {
				fs.copyFileSync(builtPath, targetPath);
				fs.unlinkSync(builtPath);
			}
		}
	};
}
