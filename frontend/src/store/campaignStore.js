import { reactive, ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
import Room from "../classes/Room";
import Option from "../classes/Option";
import Campaign from "../classes/Campaign";

const campaignStore = defineStore('campaignStore', () => {
    const campaigns = ref([]);

    const campaignId = ref(1) ;
    const campaignRooms = ref([]);
    const campaignOptions = ref([]);

    axios.get("http://localhost/VisualNova/backend/api/room?campaign_id=" + campaignId.value)
    .then(response => {
        
    }).catch((err) => {
        alert("Error during fetching data!")
    });

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

export default campaignStore;
