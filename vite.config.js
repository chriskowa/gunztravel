import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vitePrerender from 'vite-plugin-prerender'
import path from 'path'

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
      postProcess(renderedRoute) {
        renderedRoute.html = renderedRoute.html
          .replace(/id="app"/, 'id="app" data-server-rendered="true"');
        return renderedRoute;
      }
    }),
  ],
})
