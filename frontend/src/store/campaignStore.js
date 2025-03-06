import { reactive, ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

const campaignStore = defineStore('campaignStore', () => {
    const campaigns = ref([]);

    const addCampaign = (camp) => {
        campaigns.value.push(camp);
    }

    const removeCampaign = (camp) => {
        campaigns.value.splice(camp, 1);
    }

    const getCampaigns = () => {
        return campaigns.value;
    }

    return { addCampaign, removeCampaign, getCampaigns };

});
