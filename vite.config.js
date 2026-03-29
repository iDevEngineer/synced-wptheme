import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [tailwindcss()],
  build: {
    outDir: 'assets/dist',
    rollupOptions: {
      input: {
        app: 'assets/src/css/app.css',
        js: 'assets/src/js/app.js',
      },
    },
    manifest: true,
  },
  server: {
    port: 3000,
  },
})
