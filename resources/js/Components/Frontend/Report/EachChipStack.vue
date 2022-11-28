<template>
    <CustomeTable>
        <template v-slot:table-body>
            <tr v-for="(item, index) in eventChips" :key="index">
                <td v-if="item.player?.name">
                    <img
                        class="hide-on-mobile"
                        v-if="item.player?.avatar"
                        :src="item.player?.avatar"
                        :alt="item.player?.avatar"
                    />
                    <img
                        class="hide-on-mobile"
                        v-else
                        :src="defaultAvatar"
                        :alt="defaultAvatar"
                    />
                    {{ item.player?.name }}
                    <span style="white-space: nowrap"></span>
                </td>
                <td class="text-center hide-on-tablet" v-else>-</td>
                <td
                    class="text-center hide-on-tablet"
                    v-if="item.player?.name && item.player?.country"
                >
                    <CountryFlag
                        :title="item.player?.country"
                        :iso="item.player?.flag"
                    />
                </td>
                <td class="text-center hide-on-tablet" v-else>-</td>
                <td v-if="item.player?.badge">
                    <img :src="item.player?.badge" :alt="item.player?.badge" />
                </td>
                <td v-else></td>
                <td v-if="item.player?.name" class="text-right">
                    {{
                        item.current_chips === 0
                            ? "BUSTED"
                            : item.current_chips.toLocaleString()
                    }}
                </td>
                <td class="text-center hide-on-tablet" v-else>-</td>
                <td v-if="item.player?.name" class="text-right hide-on-mobile">
                    {{
                        item.current_chips === 0
                            ? ""
                            : item.changes.toLocaleString()
                    }}
                    <span v-if="item.symbol === 'up'" style="margin-left: 10px"
                        ><i
                            v-if="item.current_chips != 0"
                            class="fa-sharp fa-solid fa-caret-up text-green"
                        ></i
                    ></span>
                    <span v-else style="margin-left: 10px"
                        ><i
                            v-if="item.current_chips != 0"
                            class="fa-sharp fa-solid fa-caret-down text-red"
                        ></i
                    ></span>
                </td>
                <td class="text-center hide-on-tablet" v-else>-</td>
            </tr>
        </template>
    </CustomeTable>
</template>

<script setup>
import CountryFlag from "vue3-country-flag-icon";

import CustomeTable from "../CustomeTable.vue";
import defaultAvatar from "@/default-avatar.png";

const props = defineProps({
    eventChips: {
        type: Object,
    },
});
</script>

<style scoped>
.text-green {
    color: #2ecc71;
}

.text-red {
    color: #e74c3c;
}
</style>
