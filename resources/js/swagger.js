/* eslint-disable */
const swaggerJson = `${window.location.origin}/swagger.json`;
window.onload = function () {
  const ui = SwaggerUIBundle({
    url: swaggerJson,
    dom_id: '#swagger-ui',
    deepLinking: true,
    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset,
    ],
    plugins: [
      SwaggerUIBundle.plugins.DownloadUrl,
    ],
    layout: 'StandaloneLayout',
  });

  window.ui = ui;
};
/* eslint-enable */
