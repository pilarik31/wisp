class Polyline {
    public self: number;
    public target: number;

    public selfLat: number;
    public selfLng: number;

    public targetLat: number;
    public targetLng: number;

    constructor(
        self: number,
        target: number,
        selfLat: number,
        selfLng: number,
        targetLat: number,
        targetLng: number
    ) {
        this.self = self;
        this.target = target;
        this.selfLat = selfLat;
        this.selfLng = selfLng;
        this.targetLat = targetLat;
        this.targetLng = targetLng;
    }
}

export default Polyline;
