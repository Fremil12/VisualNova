class Option{
    #text;
    #next;
    #functions;
    constructor(text,next,functions) {
        this.setText(text);
        this.setNext(next);
        this.setFunctions(functions);

        this.setText = this.setText.bind(this);
        this.setNext = this.setNext.bind(this);
        this.setFunctions = this.setFunctions.bind(this);
    }

    function setText(param){
        this.#text = param;
    }
    function setNext(param){
        this.#next = param;
    }
    function setFunctions(param){
        this.#functions = param;
    }
    
    function getText(){
        return this.#text;
    }
    function getNext(){
        return this.#next;
    }
    function getFunctions(){
        return this.#functions;
    }

}