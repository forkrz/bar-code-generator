export class Validator{
    inputEmpty = (type,value) =>{
        if(!type || !value){
            return true;
        }
    }

    checkIfTypeRequiresOnlyNumbers = (type) =>{
        const types = ["EAN5","EAN8","EAN13","UPCE","IMB","MSI","S25","I25","C128A","C128C","POSTNET","PLANET","IMB","CODABAR","CODE11"];
        return types.includes(type)
    }

    checkIfStringContainsLetters = (value, type) =>{
        if(this.checkIfTypeRequiresOnlyNumbers(type)){
            return /[a-zA-Z]/.test(value);
        }
                
    }
}