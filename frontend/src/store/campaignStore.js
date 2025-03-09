import { reactive, ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
import Room from "../classes/Room";
import Option from "../classes/Option";
import Campaign from "../classes/Campaign";

const campaignStore = defineStore("campaignStore", () => {
  const campaigns = ref([]);

  const campaignId = ref(1);
  const campaignRooms = ref([]);
  const campaignOptions = ref([]);

  axios
    .get(
      "http://localhost/VisualNova/backend/api/room?campaign_id=" +
        campaignId.value
    )
    .then((roomResponse) => {
      for (var i = 0; i < roomResponse.length; i++) {
        campaignRooms.value.push(
          new Room(
            roomResponse[i].room_background,
            roomResponse[i].room_image,
            roomResponse[i].room_text,
            roomResponse[i].isFirst
          )
        );
      }
      /*axios
        .get(
          "http://localhost/VisualNova/backend/api/option?room_id=" +
            roomResponse[0].id
        )
        .then((optionResponse) => {
          for (var j = 0; j < optionResponse.length; i++) {
            campaignOptions.value.push(
              new Option(
                optionResponse[j].text,
                optionResponse[j].next_room_id,
                []
              )
            );
          }
        })
        .catch((err) => {
          alert("Error during fetching option data: " + err);
        });*/
    })
    .catch((err) => {
      alert("Error during fetching room data: " + err);
    });
  addCampaign(new Campaign(campaignRooms.value, campaignOptions.value, []));

  const addCampaign = (camp) => {
    campaigns.value.push(camp);
  };

  const removeCampaign = (camp) => {
    campaigns.value.splice(camp, 1);
  };

  const getCampaigns = () => {
    return campaigns.value;
  };

  return { addCampaign, removeCampaign, getCampaigns };
});

export default campaignStore;
