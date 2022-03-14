import { Api } from "./Api.js";
import { DomElementGenerator } from "./DomElementGenerator.js";
import { Validator } from "./Validator.js";

export class MainPage {
  constructor() {
    this.api = new Api();
    this.validator = new Validator();
    this.domElementGenerator = new DomElementGenerator();
  }
  generateBtnAddEventListener = () => {
    const btn = document.getElementById("btnBarcodeGenerator");
    btn.addEventListener("click", async (e) => {
      e.preventDefault();

      let type = document.getElementById("codeSelect").value;
      let value = document.getElementById("valueInput").value;
      document.getElementById("img-container").classList.add("hide");

      if (document.getElementById("reqInfo")) {
        this.domElementGenerator.removeElement(
          document.getElementById("reqInfo")
        );
      }

      if (this.validator.inputEmpty(type, value)) {
        this.domElementGenerator.addParagraph(
          "Both values cannot be empty",
          "text-danger"
        );
        return;
      }
      
      if (this.validator.checkIfStringContainsLetters(value, type)) {
        this.domElementGenerator.addParagraph(
          "This barcode only can be generated  with numbers",
          "text-danger"
        );
        return;
      }

      let res = await this.api.getBarcode(type, value);
      let msg = await res.json();

      if (res.status != 200) {
        this.domElementGenerator.addParagraph(msg["msg"], "text-danger");
        return;
      } else {
        this.updateBarcodeImg();
      }
      document.getElementById("img-container").classList.remove("hide");
    });
  };

  displayValidsecription = () => {
    const type = document.getElementById("codeSelect");
    type.addEventListener("change", () => {
      document.getElementById("img-container").classList.add("hide");
      if (document.getElementById("reqInfo")) {
        this.domElementGenerator.removeElement(
          document.getElementById("reqInfo")
        );
      }
      if (this.validator.checkIfTypeRequiresOnlyNumbers(type.value)) {
        this.domElementGenerator.addParagraph(
          "This barcode can only be generated with numbers",
          "text-white"
        );
      }
    });
  };

  updateBarcodeImg = () => {
    const img = document.getElementById("img");
    let timeStamp = new Date().getTime();
    let newSrc = img.src + "?=" + timeStamp;
    img.src = newSrc;
  };
}
