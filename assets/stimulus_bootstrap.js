import { Application } from '@hotwired/stimulus';
import NavbarController from './controllers/navbar_controller.js';

window.Stimulus = Application.start();
Stimulus.register('navbar', NavbarController);
