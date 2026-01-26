import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['menu'];

    toggle() {
      const isOpen = this.menuTarget.dataset.state === 'open';
      this.menuTarget.dataset.state = isOpen ? 'closed' : 'open';
      if (this.menuTarget.dataset.state === 'open') {
        this.menuTarget.classList.remove('invisible', 'opacity-0', 'translate-y-4');
        this.menuTarget.classList.add('visible', 'opacity-100', 'translate-y-0');
      } else {
        this.menuTarget.classList.remove('visible', 'opacity-100', 'translate-y-0');
        this.menuTarget.classList.add('invisible', 'opacity-0', 'translate-y-4');
      }
    }
}
