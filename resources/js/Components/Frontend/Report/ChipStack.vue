<template>
    <div class="margin-top">
        <div v-if="chipCounts.length">
            <CustomeTable>
                <template v-slot:table-head>
                    <tr class="text-primary">
                        <th class="text-center">Rank</th>
                        <th>Player</th>
                        <th class="text-center hide-on-tablet">Country</th>
                        <th></th>
                        <th class="text-right">Chips</th>
                        <th class="text-right hide-on-mobile">Progress</th>
                    </tr>
                </template>
                <template v-slot:table-body>
                    <tr v-for="(stack, index) in chipCounts" :key="index">
                        <td class="text-center">
                            {{ index + 1 }}
                        </td>
                        <td>
                            <img
                                class="hide-on-tablet"
                                v-if="stack?.player?.avatar"
                                :src="stack?.player?.avatar"
                                :alt="stack?.player?.avatar"
                            />
                            <img
                                class="hide-on-tablet"
                                v-else
                                :src="defaultAvatar"
                                :alt="defaultAvatar"
                            />
                            <span
                                style="white-space: nowrap"
                                v-if="stack.player"
                                >{{ stack?.player?.name }}
                                <span
                                    class="hide-on-tablet"
                                    v-if="stack.player?.pseudonym"
                                    >({{ stack.player?.pseudonym }})</span
                                ></span
                            >
                            <span style="white-space: nowrap" v-else>-</span>
                        </td>
                        <td
                            class="text-center hide-on-tablet"
                            v-if="stack?.player?.country"
                        >
                            <CountryFlag
                                :title="stack?.player?.country"
                                :iso="stack?.player?.flag"
                            />
                        </td>
                        <td class="text-center hide-on-tablet" v-else>-</td>
                        <td v-if="stack.player?.badge">
                            <img
                                :src="stack.player?.badge"
                                :alt="stack.player?.badge"
                            />
                        </td>
                        <td v-else></td>
                        <td v-if="stack.report_id" class="text-right">
                            {{ stack.current_chips.toLocaleString() }}
                        </td>
                        <td v-else class="text-right">
                            {{
                                stack.current_chips === 0
                                    ? "BUSTED"
                                    : stack.current_chips.toLocaleString()
                            }}
                        </td>
                        <td class="text-right hide-on-mobile">
                            {{
                                stack.current_chips === 0
                                    ? ""
                                    : stack.changes.toLocaleString()
                            }}
                            <span
                                v-if="stack.symbol === 'up'"
                                style="margin-left: 10px"
                                ><i
                                    v-if="stack.current_chips != 0"
                                    class="fa-sharp fa-solid fa-caret-up text-green"
                                ></i
                            ></span>
                            <span v-else style="margin-left: 10px"
                                ><i
                                    v-if="stack.current_chips != 0"
                                    class="fa-sharp fa-solid fa-caret-down text-red"
                                ></i
                            ></span>
                        </td>
                    </tr>
                </template>
            </CustomeTable>
        </div>
        <div v-else>
            <h4>There are no chip counts at the moment.</h4>
        </div>
    </div>
</template>

<script setup>
import CountryFlag from "vue3-country-flag-icon";

import CustomeTable from "../CustomeTable.vue";
import defaultAvatar from "@/default-avatar.png";

const props = defineProps({
    chipCounts: {
        type: Object,
    },
});
</script>

<style scoped>
.margin-top {
    margin-top: 20px;
}

.text-green {
    color: #2ecc71;
}

.text-red {
    color: #e74c3c;
}
</style>
