<?php

namespace App\Livewire;

/**
 * Legacy MediaCarousel Component
 * 
 * This component has been moved to App\Livewire\Media\MediaCarousel
 * for better organization. This file serves as a backward compatibility
 * bridge to prevent breaking existing references.
 * 
 * @deprecated Use App\Livewire\Media\MediaCarousel instead
 * @package App\Livewire
 */

use App\Livewire\Media\MediaCarousel as BaseMediaCarousel;

/**
 * Legacy MediaCarousel class
 * 
 * This extends the new organized MediaCarousel component to maintain
 * backward compatibility while encouraging migration to the new structure.
 */
class MediaCarousel extends BaseMediaCarousel
{
    // This class intentionally extends the new MediaCarousel
    // to maintain backward compatibility
}
