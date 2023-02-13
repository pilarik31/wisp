<template>
    <button @click="newMarker">New marker</button>
    <button @click="processPolylines">make polylines</button>
    <div style="height: 900px; width: 100%">
        <l-map
            ref="map"
            v-model:zoom="zoom"
            v-model:center="center"
            @move="log('move map')"
        >
            <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                layer-type="base"
                name="OpenStreetMap"
            ></l-tile-layer>

            <l-control-layers />
            <div v-for="pin in pins" :key="pin.id">
                <l-marker
                    :lat-lng="[pin.lat, pin.lng]"
                    draggable
                    @moveend="log('moveend marker')"
                >
                    <l-icon :icon-url="iconUrl" :icon-size="iconSize" />
                    <l-tooltip>
                        <span>{{ pin.tooltip }}</span>
                    </l-tooltip>
                </l-marker>
            </div>

            <div v-for="polyline in polylines" :key="polyline.self">
                <l-polyline
                    :lat-lngs="[
                        [polyline.selfLat, polyline.selfLng],
                        [polyline.targetLat, polyline.targetLng],
                    ]"
                    color="green"
                ></l-polyline>
            </div>
        </l-map>
    </div>
</template>

<script lang="ts">
import "leaflet/dist/leaflet.css";
import axios from "axios";
import {
    LMap,
    LTileLayer,
    LControlLayers,
    LMarker,
    LIcon,
    LTooltip,
    LPolyline,
} from "@vue-leaflet/vue-leaflet";
import { toRaw } from "vue";
import Polyline from "../ts/Polyline";

export default {
    name: "MapComponent",
    components: {
        LMap,
        LTileLayer,
        LControlLayers,
        LMarker,
        LIcon,
        LTooltip,
        LPolyline,
    },
    data() {
        return {
            zoom: 16,
            iconWidth: 40,
            iconHeight: 40,
            center: [49.88914, 15.47214],
            pins: [] as Pin[],
            polylines: [] as Polyline[],
        };
    },
    computed: {
        iconUrl(): string {
            return "radio-tower.png";
        },
        iconSize(): number[] {
            return [this.iconWidth, this.iconHeight];
        },
    },
    methods: {
        log(a: any) {
            console.log(a);
        },
        async getPins(): Promise<void> {
            const response = await axios.get("/api/pins");
            this.pins = response.data;
        },
        async newMarker() {
            // TODO: send new marker to server
        },
        async updateMarker(pin: Pin): Promise<void> {
            // TODO: send post request to update marker to server
        },
        async processPolylines(): Promise<void> {
            const raw = toRaw(this.pins);
            Object.keys(raw).forEach((key) => {
                const pin = raw[parseInt(key)];
                if (pin.ptp !== null) {
                    const polyline = new Polyline(
                        pin.id,
                        pin.ptp,
                        pin.lat,
                        pin.lng,
                        raw[pin.ptp].lat,
                        raw[pin.ptp].lng
                    );
                    this.polylines.push(polyline);
                }
            });
        },
    },
    mounted() {
        this.getPins().then(() => {
            this.processPolylines();
        });
    },
};
</script>

<style scoped></style>
