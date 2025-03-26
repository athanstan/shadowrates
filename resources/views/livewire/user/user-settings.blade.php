<div class="container px-4 mx-auto">
    <x-atoms.neo-brutal-panel class="my-8">
        <div x-data="{ activeTab: 'profile' }">
            <!-- Tabs -->
            <div class="flex mb-6 border-b border-gray-700">
                <button @click="activeTab = 'profile'"
                    :class="{ 'text-purple-400 border-b-2 border-purple-400': activeTab === 'profile', 'text-gray-400': activeTab !== 'profile' }"
                    class="px-4 py-2 mr-4 font-medium">
                    Profile Info
                </button>
                <button @click="activeTab = 'social'"
                    :class="{ 'text-purple-400 border-b-2 border-purple-400': activeTab === 'social', 'text-gray-400': activeTab !== 'social' }"
                    class="px-4 py-2 mr-4 font-medium">
                    Social Links
                </button>
            </div>

            <form wire:submit="save">
                <div x-show="activeTab === 'profile'">
                    <x-molecules.section-heading title="Profile Settings" subtitle="Update your personal information" />

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <x-atoms.text-input label="Country" id="country" wire:model="country"
                            placeholder="Your country" :error="$errors->first('country')" />

                        <x-atoms.text-input label="City" id="city" wire:model="city" placeholder="Your city"
                            :error="$errors->first('city')" />
                    </div>

                    <div class="mt-4">
                        <x-atoms.select-input label="Favorite Class" id="favorite_class" wire:model="favorite_class"
                            :error="$errors->first('favorite_class')">
                            <option value="">Select your favorite class</option>
                            <option value="Forestcraft">Forestcraft</option>
                            <option value="Swordcraft">Swordcraft</option>
                            <option value="Runecraft">Runecraft</option>
                            <option value="Dragoncraft">Dragoncraft</option>
                            <option value="Shadowcraft">Shadowcraft</option>
                            <option value="Bloodcraft">Bloodcraft</option>
                            <option value="Havencraft">Havencraft</option>
                            <option value="Portalcraft">Portalcraft</option>
                        </x-atoms.select-input>
                    </div>

                    <div class="mt-4">
                        <x-atoms.textarea-input label="Bio" id="bio" wire:model="bio"
                            placeholder="Tell us about yourself" rows="5" :error="$errors->first('bio')" />
                    </div>
                </div>

                <div x-show="activeTab === 'social'" x-cloak>
                    <x-molecules.section-heading title="Social Media Links" subtitle="Connect your social profiles" />

                    <div class="space-y-4">
                        @foreach ($socialLinks as $socialLink)
                            <div
                                class="grid items-center grid-cols-1 p-4 border border-gray-800 rounded-md md:grid-cols-12">
                                <div class="flex justify-center col-span-1 mb-2 md:col-span-3 md:justify-start md:mb-0">
                                    <i class="{{ $socialLink->logo }} text-2xl text-gray-400"></i>
                                </div>
                                <div class="col-span-1 md:col-span-9">
                                    <label for="social-{{ $socialLink->id }}"
                                        class="block mb-1 text-sm font-medium text-white">
                                        {{ $socialLink->name }}
                                    </label>
                                    <div class="flex items-center">
                                        <span class="mr-2 text-gray-500">{{ $socialLink->link }}</span>
                                        <input type="text" id="social-{{ $socialLink->id }}"
                                            wire:model="userSocialLinks.{{ $socialLink->id }}"
                                            class="w-full px-4 py-2 text-white placeholder-gray-400 transition duration-200 bg-gray-800 border-2 border-gray-700 rounded-sm focus:outline-none focus:border-purple-500"
                                            placeholder="username" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <x-atoms.button type="submit" variant="primary">
                        Save Changes
                    </x-atoms.button>
                </div>
            </form>
        </div>
    </x-atoms.neo-brutal-panel>

    <div x-data="{ show: false, message: '' }"
        x-on:settings-saved.window="show = true; message = 'Settings saved successfully!'; setTimeout(() => show = false, 3000)">
        <div x-show="show" x-transition class="fixed inset-x-0 flex items-center justify-center bottom-4">
            <div class="p-4 text-sm text-white bg-green-500 rounded-md shadow-lg">
                <span x-text="message"></span>
            </div>
        </div>
    </div>
</div>
