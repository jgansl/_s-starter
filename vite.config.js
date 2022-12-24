import { defineConfig } from 'vite'
import VitePluginBrowserSync from 'vite-plugin-browser-sync'
// import EnvironmentPlugin from 'vite-plugin-environment';

// import react from '@vitejs/plugin-react'
import { svelte } from '@sveltejs/vite-plugin-svelte'

// https://vitejs.dev/config/
export default defineConfig({
  build: { //@see https://vitejs.dev/config/build-options.html
		sourcemap: true,
    outDir: 'vitebuild',
    assetsDir: 'vitebuild/assets'
  },
  plugins: [
    // react(),
    svelte(),
    //@see https://github.com/ElMassimo/vite-plugin-environment
    // EnvironmentPlugin('all', {
    //   // NODE_ENV: 'development',
    //   prefix: ''
    // }),
    VitePluginBrowserSync({
      //@see https://github.com/Applelo/vite-plugin-browser-sync
      bs: {
        ui: {
          port: 8081
        },
        // proxy: `https://${process.env.WP_PROXY}`,
        proxy: `https://starter.local`,
				ghostMode: false,
        notify: false,
        host: 'localhost',
				// https: {
				// 	key: process.env.HTTPS_KEY ? process.env.HTTPS_KEY : `${homeDir}/.theme/localhost.key`,
				// 	cert: process.env.HTTPS_CERT ? process.env.HTTPS_CERT : `${homeDir}/.theme/localhost.crt`,
				// },
				https: {
					key: `/Users/jessegansler/.theme/localhost.key`,
					cert: `/Users/jessegansler/.theme/localhost.crt`,
				},
        files: [
					'**/*.php',
					'build/*/*.css',
          'build/*/*.js',
					'!node_modules',
					'!.git',
				],
      }
    })
  ]
})
