// base-rutas.js
const esLocal = location.hostname === "localhost" || location.hostname === "127.0.0.1";
const BASE_URL = esLocal ? "/estetica/public" : "/Agostina-Estetica/public";

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("a[data-base], link[data-base], script[data-base]").forEach(el => {
    const attr = el.hasAttribute("href") ? "href" : "src";
    const ruta = el.getAttribute(attr);

    // Evitar si ya tiene BASE_URL o es absoluta
    if (
      !ruta || 
      ruta.startsWith("http") || 
      ruta.startsWith("https") || 
      ruta.startsWith("mailto") || 
      ruta.startsWith(BASE_URL)
    ) return;

    // Agregar BASE_URL si empieza con "/", sino agregar "/"
    const cleanRuta = ruta.startsWith("/") ? ruta : "/" + ruta;
    el.setAttribute(attr, BASE_URL + cleanRuta);
  });
});
