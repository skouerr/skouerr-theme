function App() {
  return /* @__PURE__ */ React.createElement("div", null, "Coucou");
}
const BlockTemplateRender = () => {
  console.log("BlockTemplateRender");
  ReactDOM.render(/* @__PURE__ */ React.createElement(App, null), document.getElementById("skouerr-block-template"));
};
document.addEventListener("DOMContentLoaded", () => {
  console.log("DOMContentLoaded Template Script");
  BlockTemplateRender();
});
