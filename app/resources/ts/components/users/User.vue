<script setup lang="ts">
import UserIconImage from '@/components/users/UserIconImage.vue';
import UserDetail from '@/components/users/UserDetail.vue';
import FollowButton from '@/components/users/FollowButton.vue';

</script>

<template>
    <div class="cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
        <div class="px-4 py-2">
            <div class="flex items-start space-x-4">
                <UserIconImage icon_image="" />
                <div class="flex-1">
                    <UserDetail name="伊東 豊（セガ・龍が如くスタジオ技術責任者）" user-id="@YutakaIto_RGG"
                        introduction="龍が如くスタジオの技術責任者です。プログラマーのボスで、たまにディレクターもやったりします。 ファイティングバイパーズ/ファイターズメガミックス/スパイクアウト/スラッシュアウト/バーチャストライカー/F-ZERO AX・GX/スーパーモンキーボール/ジャッジアイズ/ロストジャッジメント/龍が如くシリーズ">
                        <FollowButton user-id="@YutakaIto_RGG" :is-follow="true" />
                    </UserDetail>
                </div>
            </div>
        </div>
    </div>
</template>