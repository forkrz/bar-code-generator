import { Api } from "./Api.js";
import { DomElementGenerator } from "./DomElementGenerator.js";
import { Validator } from "./Validator.js";
export class MainPage {
  constructor() {
    this.api = new Api();
    this.Validator = new Validator();
    this.DomElementGenerator = new DomElementGenerator();
  }
  generateBtnAddEventListener = () => {
    const btn = document.getElementById("btnBarcodeGenerator");
    btn.addEventListener("click", async (e) => {
      e.preventDefault();

      let type = document.getElementById("codeSelect").value;
      let value = document.getElementById("valueInput").value;
      document.getElementById('img-container').classList.add('hide');
      if (document.getElementById("reqInfo")) {
        this.DomElementGenerator.removeElement(
          document.getElementById("reqInfo")
        );
      }

      if (this.Validator.checkIfInputEmpty(type, value)) {
        this.DomElementGenerator.addParagraph("Both values cannot be empty", "text-danger");
        return;
      }

      if (this.Validator.doesStringContainsLetters(value, type)) {
        this.DomElementGenerator.addParagraph("This barcode only can be generated  with numbers", "text-danger");
        return;
      }

      let res = await this.api.getBarcode(type, value);
      let msg = await res.json();

      if (res.status != 200) {
        this.DomElementGenerator.addParagraph(msg["msg"], "text-danger");
        return;
      }
      document.getElementById('img-container').classList.remove('hide');
    });
  };

  listAddEventListeer = () => {
    const type = document.getElementById("codeSelect");
    type.addEventListener("change", () => {
      document.getElementById("img-container").classList.add("hide");
      if (document.getElementById("reqInfo")) {
        this.DomElementGenerator.removeElement(
          document.getElementById("reqInfo")
        );
      }
      if (this.Validator.doesCodeCanBeGeneratedOnlyWithNumChars(type.value)) {
        this.DomElementGenerator.addParagraph(
          "This barcode can only be generated with numbers",
          "text-white"
        );
      }
    });
  };
}
