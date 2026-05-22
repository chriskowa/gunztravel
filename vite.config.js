import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'
import { createRequire } from 'module'
import { fileURLToPath } from 'url'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

globalThis.require = createRequire(import.meta.url)
const vitePrerender = (await import('vite-plugin-prerender')).default

export default defineConfig({
  plugins: [
    vue(),
    vitePrerender({
      staticDir: path.join(__dirname, 'dist'),
      routes: [
        '/',
        '/travel-malang-surabaya/',
        '/travel-malang-juanda/',
        '/travel-juanda-malang/',
        '/travel-batu-juanda/',
        '/travel-batu-surabaya/',
        '/travel-surabaya-batu/',
        '/sewa-mobil-malang/',
        '/paket-wisata-bromo/',
        '/wisata-religi-malang/',
        '/city-tour-malang-batu/',
        '/blog/',
        '/contact/'
      ],
      renderer: new vitePrerender.PuppeteerRenderer({
        renderAfterDocumentEvent: 'x-app-rendered'
      }),
      postProcess(renderedRoute) {
        renderedRoute.html = renderedRoute.html
          .replace(/id="app"/, 'id="app" data-server-rendered="true"');
        return renderedRoute;
      }
    }),
  ],
  build: {
    target: 'es2019'
  }
})
