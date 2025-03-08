export default class Campaign{
    #rooms;
    #options;
    #battles;

    constructor(rooms,options,battles){
        this.setRooms(rooms);
        this.setOptions(options);
        this.setBattles(battles);

        this.setOptions = this.setOptions.bind(this);
        this.setBattles = this.setBattles.bind(this);
        this.setRooms = this.setRooms.bind(this);

        this.getOptions = this.getOptions.bind(this);
        this.getBattles = this.getBattles.bind(this);
        this.getRooms = this.getRooms.bind(this);
    }


    setRooms(params) {
        this.#rooms = params;
    }
    setOptions(params) {
        this.#options = params;
    }
    setBattles(params) {
        this.#battles = params;
    }
    
    getRooms() {
        return this.#rooms;
    }
    getOptions() {
        return this.#options;
    }
    getBattles() {
        return this.#battles;
    }
}