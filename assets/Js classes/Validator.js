export class Validator{
    checkIfInputEmpty = (type,value) =>{
        if(!type || !value){
            return true;
        }
    }

    doesStringContainsLetters = (value, type) =>{
        const types = ["EAN8","EAN13","UPCE","IMB"];
        if(types.includes(type)){
                return /^\d+$/.test(value);
        }
    }
}