document.addEventListener("DOMContentLoaded", () => {
  const blockDocumentation = document.querySelectorAll(".block-documentation");
  blockDocumentation.forEach((block) => {
    console.log("Block", block);
    handleBlockDocumentation(block);
  });
  const code = document.querySelectorAll("pre code");
  code.forEach((block) => {
    handleCodeBlock(block);
  });
  hljs.highlightAll();
});
const handleBlockDocumentation = (block) => {
  const navigation = block.querySelector(".navigation");
  const content = block.querySelector(".content");
  const titlesInContent = content.querySelectorAll("h1, h2");
  const navigationItems = navigation.querySelectorAll("a");
  document.addEventListener("scroll", () => {
    var _a;
    const scrollPosition = window.scrollY;
    let currentTitle = null;
    titlesInContent.forEach((title) => {
      if (title.offsetTop <= scrollPosition + 200) {
        currentTitle = title.textContent;
      }
    });
    const currentAnchor = navigation.querySelector('a[data-title="' + currentTitle + '"]');
    navigationItems.forEach((item) => {
      var _a2;
      (_a2 = item == null ? void 0 : item.classList) == null ? void 0 : _a2.remove("active");
    });
    (_a = currentAnchor == null ? void 0 : currentAnchor.classList) == null ? void 0 : _a.add("active");
    const sanitizedTitle = currentTitle.replace(/ /g, "-").toLowerCase();
    window.history.pushState(null, null, "#" + sanitizedTitle);
  });
  navigationItems.forEach((item) => {
    console.log("navigation items", item);
    item.addEventListener("click", (event) => {
      var _a;
      event.preventDefault();
      const title = event.target.getAttribute("data-title");
      const element = Array.from(titlesInContent).find((titleElement) => titleElement.textContent === title);
      window.scrollTo({
        top: element.offsetTop - 40,
        behavior: "smooth"
      });
      navigationItems.forEach((item2) => {
        var _a2;
        (_a2 = item2 == null ? void 0 : item2.classList) == null ? void 0 : _a2.remove("active");
      });
      (_a = item.classList) == null ? void 0 : _a.add("active");
    });
  });
};
const handleCodeBlock = (block) => {
  block.addEventListener("click", (event) => {
    const range = document.createRange();
    range.selectNodeContents(block);
    const selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("copy");
    selection.removeAllRanges();
    const tooltip = document.createElement("div");
    tooltip.classList.add("tooltip");
    tooltip.textContent = "Copied!";
    block.appendChild(tooltip);
    setTimeout(() => {
      block.removeChild(tooltip);
    }, 1e3);
  });
};
