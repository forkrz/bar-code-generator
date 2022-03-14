export class Api {
  constructor() {
    this.url = "http://barcode.loc/api/barcodeGenerator";
  }

  generatePostData = (codeType, value) => {
    const data = JSON.stringify({
      value: value,
      type: codeType,
    });

    return data;
  };

  getBarcode = async (codeType, value) => {
    const query = await fetch(this.url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: this.generatePostData(codeType, value),
    });
    return query;
  };
}
