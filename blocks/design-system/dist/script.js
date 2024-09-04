document.addEventListener("DOMContentLoaded", () => {
  const designSystem = document.querySelectorAll(".block-design-system");
  designSystem.forEach((block) => {
    handleDesignSystem(block);
  });
  hljs.highlightAll();
});
const handleDesignSystem = (block) => {
  const atoms = block.querySelectorAll(".atom");
  console.log("Atoms", atoms);
  atoms.forEach((atom) => {
    handleAtom(atom);
  });
  const colorBlocks = block.querySelectorAll(".color-block");
  colorBlocks.forEach((colorBlock) => {
    handleColorBlock(colorBlock);
  });
};
const handleAtom = (atom) => {
  const code = atom.querySelector(".code code");
  const preview = atom.querySelector(".preview");
  code.textContent = preview.innerHTML.trim();
  divCopy = document.createElement("div");
  divCopy.classList.add("copy");
  code.parentElement.appendChild(divCopy);
  code.addEventListener("input", (event) => {
    preview.innerHTML = event.target.textContent;
  });
  divCopy.addEventListener("click", (event) => {
    const range = document.createRange();
    range.selectNodeContents(code);
    const selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("copy");
    selection.removeAllRanges();
    const tooltip = document.createElement("div");
    tooltip.classList.add("tooltip");
    tooltip.textContent = "Copied!";
    code.parentElement.appendChild(tooltip);
    setTimeout(() => {
      code.parentElement.removeChild(tooltip);
    }, 1e3);
  });
};
const handleColorBlock = (colorBlock) => {
  colorBlock.addEventListener("click", async (e) => {
    const variable = colorBlock.getAttribute("data-variable");
    const title = colorBlock.getAttribute("data-title");
    await navigator.clipboard.writeText(variable);
    colorBlock.innerText = `Variable copied!`;
    setTimeout(() => {
      colorBlock.innerText = title;
    }, 1e3);
  });
};
