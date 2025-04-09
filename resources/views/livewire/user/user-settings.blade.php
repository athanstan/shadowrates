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

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <x-atoms.text-input label="Username" id="username" wire:model="username"
                            placeholder="Your username" :error="$errors->first('username')" />

                        <x-atoms.text-input label="Country" id="country" wire:model="country"
                            placeholder="Your country" :error="$errors->first('country')" />

                        <x-atoms.text-input label="City" id="city" wire:model="city" placeholder="Your city"
                            :error="$errors->first('city')" />
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <div class="w-12 h-12 rounded-lg {{ \App\Enums\Craft::from($favorite_class)->background() }}">
                        </div>
                        <div class="flex-1">
                            <x-atoms.select-input label="Favorite Craft" id="favorite_class" wire:model="favorite_class"
                                :options="\App\Enums\Craft::cases()" emptyOption="Select your favorite craft" optionValue="value"
                                optionLabel="name" :error="$errors->first('favorite_class')" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-atoms.textarea-input label="Bio" id="bio" wire:model="bio"
                            placeholder="Tell us about yourself" rows="5" :error="$errors->first('bio')" />
                    </div>
                </div>
                <div x-show="activeTab === 'social'" x-cloak>
                    <x-molecules.section-heading title="Social Media Links"
                        subtitle="Connect your social profiles and let fellow players connect with you" />

                    <div class="space-y-4">
                        @foreach ($socialLinks as $socialLink)
                            <div
                                class="flex flex-col p-4 border border-gray-800 rounded-md md:flex-row md:items-center">
                                <div class="flex items-center mb-3 md:mb-0 md:mr-4 md:w-1/4">
                                    <i class="{{ $socialLink->logo }} text-2xl text-gray-400 mr-3"></i>
                                    <span class="font-medium text-white">{{ $socialLink->name }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center w-full">
                                        <span
                                            class="mr-2 text-gray-500 whitespace-nowrap">{{ $socialLink->link }}</span>
                                        <div class="flex-1">
                                            <input type="text" id="social-{{ $socialLink->id }}"
                                                wire:model="userSocialLinks.{{ $socialLink->id }}"
                                                class="w-full px-4 py-2 text-white placeholder-gray-400 transition duration-200 bg-gray-800 border-2 border-gray-700 rounded-md focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                                                placeholder="username" aria-label="{{ $socialLink->name }} username" />
                                        </div>
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
</div>
