import './bootstrap';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import AutoAnimate from '@marcreichel/alpine-auto-animate';

Alpine.plugin(AutoAnimate);

Livewire.start()
