const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"]},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"]},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"]},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"],"parameters":["key","tags"]},"debugbar.queries.explain":{"uri":"_debugbar\/queries\/explain","methods":["POST"]},"log-viewer.hosts":{"uri":"log-viewer\/api\/hosts","methods":["GET","HEAD"]},"log-viewer.folders":{"uri":"log-viewer\/api\/folders","methods":["GET","HEAD"]},"log-viewer.folders.request-download":{"uri":"log-viewer\/api\/folders\/{folderIdentifier}\/download\/request","methods":["GET","HEAD"],"parameters":["folderIdentifier"]},"log-viewer.folders.clear-cache":{"uri":"log-viewer\/api\/folders\/{folderIdentifier}\/clear-cache","methods":["POST"],"parameters":["folderIdentifier"]},"log-viewer.folders.delete":{"uri":"log-viewer\/api\/folders\/{folderIdentifier}","methods":["DELETE"],"parameters":["folderIdentifier"]},"log-viewer.files":{"uri":"log-viewer\/api\/files","methods":["GET","HEAD"]},"log-viewer.files.request-download":{"uri":"log-viewer\/api\/files\/{fileIdentifier}\/download\/request","methods":["GET","HEAD"],"parameters":["fileIdentifier"]},"log-viewer.files.clear-cache":{"uri":"log-viewer\/api\/files\/{fileIdentifier}\/clear-cache","methods":["POST"],"parameters":["fileIdentifier"]},"log-viewer.files.delete":{"uri":"log-viewer\/api\/files\/{fileIdentifier}","methods":["DELETE"],"parameters":["fileIdentifier"]},"log-viewer.files.clear-cache-all":{"uri":"log-viewer\/api\/clear-cache-all","methods":["POST"]},"log-viewer.files.delete-multiple-files":{"uri":"log-viewer\/api\/delete-multiple-files","methods":["POST"]},"log-viewer.logs":{"uri":"log-viewer\/api\/logs","methods":["GET","HEAD"]},"log-viewer.folders.download":{"uri":"log-viewer\/api\/folders\/{folderIdentifier}\/download","methods":["GET","HEAD"],"parameters":["folderIdentifier"]},"log-viewer.files.download":{"uri":"log-viewer\/api\/files\/{fileIdentifier}\/download","methods":["GET","HEAD"],"parameters":["fileIdentifier"]},"log-viewer.index":{"uri":"log-viewer\/{view?}","methods":["GET","HEAD"],"wheres":{"view":"(.*)"},"parameters":["view"]},"admin.show_login":{"uri":"admin\/login","methods":["GET","HEAD"]},"admin.login":{"uri":"admin\/login","methods":["POST"]},"admin.index":{"uri":"admin","methods":["GET","HEAD"]},"logout":{"uri":"admin\/logout","methods":["GET","HEAD"]},"livros.index":{"uri":"livros","methods":["GET","HEAD"]},"livros.create":{"uri":"livros\/create","methods":["GET","HEAD"]},"livros.store":{"uri":"livros","methods":["POST"]},"livros.show":{"uri":"livros\/{livro}","methods":["GET","HEAD"],"parameters":["livro"]},"livros.edit":{"uri":"livros\/{livro}\/edit","methods":["GET","HEAD"],"parameters":["livro"]},"livros.update":{"uri":"livros\/{livro}","methods":["PUT","PATCH"],"parameters":["livro"]},"livros.destroy":{"uri":"livros\/{livro}","methods":["DELETE"],"parameters":["livro"]},"videos.index":{"uri":"videos","methods":["GET","HEAD"]},"videos.create":{"uri":"videos\/create","methods":["GET","HEAD"]},"videos.store":{"uri":"videos","methods":["POST"]},"videos.show":{"uri":"videos\/{video}","methods":["GET","HEAD"],"parameters":["video"]},"videos.edit":{"uri":"videos\/{video}\/edit","methods":["GET","HEAD"],"parameters":["video"]},"videos.update":{"uri":"videos\/{video}","methods":["PUT","PATCH"],"parameters":["video"]},"videos.destroy":{"uri":"videos\/{video}","methods":["DELETE"],"parameters":["video"]},"imagens.index":{"uri":"imagens","methods":["GET","HEAD"]},"imagens.create":{"uri":"imagens\/create","methods":["GET","HEAD"]},"imagens.store":{"uri":"imagens","methods":["POST"]},"imagens.show":{"uri":"imagens\/{imagem}","methods":["GET","HEAD"],"parameters":["imagem"]},"imagens.edit":{"uri":"imagens\/{imagem}\/edit","methods":["GET","HEAD"],"parameters":["imagem"]},"imagens.update":{"uri":"imagens\/{imagem}","methods":["PUT","PATCH"],"parameters":["imagem"]},"imagens.destroy":{"uri":"imagens\/{imagem}","methods":["DELETE"],"parameters":["imagem"]},"categorias.index":{"uri":"categorias","methods":["GET","HEAD"]},"categorias.create":{"uri":"categorias\/create","methods":["GET","HEAD"]},"categorias.store":{"uri":"categorias","methods":["POST"]},"categorias.show":{"uri":"categorias\/{categoria}","methods":["GET","HEAD"],"parameters":["categoria"]},"categorias.edit":{"uri":"categorias\/{categoria}\/edit","methods":["GET","HEAD"],"parameters":["categoria"]},"categorias.update":{"uri":"categorias\/{categoria}","methods":["PUT","PATCH"],"parameters":["categoria"]},"categorias.destroy":{"uri":"categorias\/{categoria}","methods":["DELETE"],"parameters":["categoria"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
