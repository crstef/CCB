<?php

use App\Models\CompetitionalEvent;
use function Laravel\Folio\name;

name('calendar-competitional');

// Get current season year for title
$currentSeasonYear = CompetitionalEvent::getCurrentSeasonYear();

// Get all active events for current season, ordered chronologically
$events = CompetitionalEvent::active()
    ->currentSeason()
    ->ordered()
    ->get();

// SEO configuration
$seo = (object) [
    'title' => 'Program Competițional ' . $currentSeasonYear . ' - CCB',
    'description' => 'Programul competițional pentru sezonul ' . $currentSeasonYear . ' cu toate evenimentele și concursurile planificate.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Program Competițional {{ $currentSeasonYear }}
                </h1>
                <p class="text-gray-600">
                    Calendarul complet al evenimentelor și competițiilor CCB
                </p>
            </div>

            <!-- Competitive Events Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                    <h2 class="text-xl font-semibold">Calendar Competițional</h2>
                    <p class="text-blue-100 text-sm mt-1">Toate evenimentele planificate pentru sezonul {{ $currentSeasonYear }}</p>
                </div>
                
                @if($events->count() > 0)
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Competiția
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Locația
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Detalii
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($events as $event)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <!-- Data -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $event->formatted_date }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $event->date_start->format('l') }}
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Competiția -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $event->nume_competitie }}
                                            </div>
                                        </td>
                                        
                                        <!-- Locația -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $event->locatie }}
                                            </div>
                                        </td>
                                        
                                        <!-- Detalii -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">
                                                @if($event->descriere)
                                                    <div class="mb-1">{{ $event->descriere }}</div>
                                                @endif
                                                @if($event->colaborare)
                                                    <div class="text-xs text-blue-600 font-medium mb-1">{{ $event->colaborare }}</div>
                                                @endif
                                                @if($event->link_inscriere_caniva)
                                                    <div class="mt-2">
                                                        <a href="{{ $event->link_inscriere_caniva }}" 
                                                           target="_blank" 
                                                           rel="noopener noreferrer"
                                                           class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full hover:bg-orange-200 transition-colors duration-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                            Înscriere Caniva
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <!-- Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($event->is_upcoming)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Programat
                                                </span>
                                            @elseif($event->is_ongoing)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    În curs
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Finalizat
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden space-y-4">
                        @foreach($events as $event)
                            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <!-- Header cu data și status -->
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <div class="text-lg font-bold text-gray-900 mb-1">
                                            {{ $event->formatted_date }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $event->date_start->format('l') }}
                                        </div>
                                    </div>
                                    @if($event->is_upcoming)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Programat
                                        </span>
                                    @elseif($event->is_ongoing)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            În curs
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Finalizat
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Competiția -->
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $event->nume_competitie }}</h3>
                                </div>
                                
                                <!-- Locația -->
                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $event->locatie }}</span>
                                </div>
                                
                                <!-- Detalii -->
                                @if($event->descriere || $event->colaborare || $event->link_inscriere_caniva)
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        @if($event->descriere)
                                            <div class="text-sm text-gray-700 leading-relaxed">
                                                <span class="font-medium text-gray-900">Descriere:</span>
                                                <div class="mt-1">{{ $event->descriere }}</div>
                                            </div>
                                        @endif
                                        @if($event->colaborare)
                                            <div class="text-sm">
                                                <span class="font-medium text-gray-900">În colaborare cu:</span>
                                                <div class="mt-1 text-blue-600 font-medium">{{ $event->colaborare }}</div>
                                            </div>
                                        @endif
                                        @if($event->link_inscriere_caniva)
                                            <div class="pt-2">
                                                <a href="{{ $event->link_inscriere_caniva }}" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer"
                                                   class="inline-flex items-center w-full justify-center px-4 py-3 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition-colors duration-200 shadow-sm">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                    Înscriere Caniva
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Nu sunt evenimente programate</h3>
                        <p class="mt-2 text-gray-500">Programul competițional pentru acest sezon va fi publicat în curând.</p>
                    </div>
                @endif
            </div>

            <!-- Navigation Footer -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8 pt-8 border-t border-gray-200">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    &larr; Pagina Principală
                </a>
                
                <a href="{{ route('documents.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Documente &rarr;
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>