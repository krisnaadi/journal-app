<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Journals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4 items-start">
                <x-card class="w-1/3">
                    <form id="journalForm" x-target="journals journalForm" action="{{ route('journals.store') }}" method="POST">
                        @csrf
                        <div class="w-full flex flex-col gap-4">
                            <div>
                                <x-text-input type="date" name="date" value="{{ old('date') ?? now()->format('Y-m-d') }}" x-autofocus/>
                                @error('date')
                                    <span class="text-sm text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <x-text-input type="text" name="title" value="{{ old('title') }}" placeholder="Title ex: Happy Day"/>
                                @error('date')
                                    <span class="text-sm text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <textarea x-data="{
                                    resize() {
                                        $el.style.height = '0px';
                                        $el.style.height = $el.scrollHeight + 'px'
                                    }
                                }" x-init="resize()" @input="resize()" type="text"
                                    placeholder="Write your day..."
                                    name="description"
                                    class="flex w-full h-auto min-h-[100px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                                    {{ old('description') }}
                                </textarea>
                                @error('date')
                                    <span class="text-sm text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <x-primary-button class="mt-4">Submit</x-primary-button>
                        </div>
                    </form>
                </x-card>
                <x-card class="flex-grow">
                    <ul class="flex flex-col gap-4" id="journals" @deleteJournal:updated="$ajax('/journals')">
                        @foreach ($journals as $journal)
                            <li>
                                <div class="border rounded p-4 relative">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $journal->date->diffForHumans() }}</p>
                                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $journal->title }}</h1>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $journal->description }}</p>
                                    <div class="absolute bottom-2 right-2 flex gap-2">
                                        <x-primary-button class="px-2 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Edit</span>
                                        </x-primary-button>
                                        <x-danger-button class="px-2 py-1" x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteJournal{{ $journal->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-trash">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M9 3h6a2 2 0 0 1 2 2v1H7V5a2 2 0 0 1 2-2z"></path>
                                            </svg>
                                            <span class="sr-only">Delete</span>
                                        </x-primary-button>
                                        <x-modal name="deleteJournal{{ $journal->id }}" :show="false">
                                            <form id="deleteJournal" method="post" action="{{ route('journals.destroy', $journal->id) }}" class="p-6" >
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete your journal?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once your deleted is deleted, journal will be permanently deleted.') }}
                                                </p>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Delete') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
