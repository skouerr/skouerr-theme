import { defineConfig, loadEnv, build } from 'vite'
import fs from 'fs'
import path from 'path'


export default defineConfig(async({ command, mode }) => {
  return { 
    build: {
        // output dir for production build
        outDir: path.resolve(__dirname, './dist'),
        emptyOutDir: true,
        // esbuild target
        target: 'es2018',
        // our entry
        rollupOptions: {
          input: {
            main: path.resolve( __dirname + '/js/theme.js')
          },
          output: {
              entryFileNames: `[name].js`,
              chunkFileNames: `[name].js`,
              assetFileNames: `[name].css`
          }
        },
        minify: true,
        write: true
    },
  }
})
