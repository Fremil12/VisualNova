export default class Room{
    #bg;
    #img;
    #paraghrap;
    #first;

    constructor(bg,img,paraghrap,first){
        this.setBg(bg);
        this.setImg(img);
        this.setParaghrap(paraghrap);
        this.setIsFirstTo(first);

        this.setBg = this.setBg.bind(this);
        this.setImg = this.setImg.bind(this);
        this.setParaghrap = this.setParaghrap.bind(this);
        this.setIsFirstTo = this.setIsFirstTo.bind(this);
        this.getBg = this.setBg.bind(this);
        this.getImg = this.setImg.bind(this);
        this.getParaghrap = this.setParaghrap.bind(this);
        this.isFirst = this.isFirst.bind(this);
    }

    setBg(params) {
        this.#bg = params;
    }
    setImg(params) {
        this.#img = params;
    }
    setParaghrap(params) {
        this.#paraghrap = params;
    }
    setIsFirstTo(params) {
        this.#first = params;
    }
    
    getBg() {
        return this.#bg;
    }
    getImg() {
        return this.#img;
    }
    getParaghrap() {
        return this.#paraghrap;
    }
    isFirst() {
        return this.#first;
    }
}