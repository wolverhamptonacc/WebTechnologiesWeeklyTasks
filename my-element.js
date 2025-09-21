// Import LitElement, html, css from CDN
import { LitElement, html, css } from 'https://unpkg.com/lit@2.7.6?module';

export class MyElement extends LitElement {
  static properties = {
    _listItems: { state: true },
    hideCompleted: {},
    greeting: {}, 
  };

  static styles = css`
    .completed {
      text-decoration-line: line-through;
      color: #777;
      cursor: pointer;
    }
    li {
      cursor: pointer;
    }
  `;

  constructor() {
    super();
    this._listItems = [
      { text: 'Start Lit Tutorial', completed: true },
      { text: 'Make to-do list', completed: false },
    ];
    this.hideCompleted = false;
    this.greeting = 'Hello from LitElement!'; 
  }


  render() {
    const items = this.hideCompleted
      ? this._listItems.filter((item) => !item.completed)
      : this._listItems;

    // Build the todos list
    const todos = html`
      <ul>
        ${items.map(
          (item) => html`
            <li
              class=${item.completed ? 'completed' : ''}
              @click=${() => this.toggleCompleted(item)}
            >
              ${item.text}
            </li>
          `
        )}
      </ul>
    `;

    const caughtUpMessage = html`<p>You're all caught up!</p>`;
    const todosOrMessage = items.length > 0 ? todos : caughtUpMessage;

    return html`
      <h2>${this.greeting}</h2>
      <h2>To Do</h2>
      ${todosOrMessage}
      <input id="newitem" aria-label="New Item">
      <button @click=${this.addToDo}>Add</button>
      <br />
      <label>
        <input
          type="checkbox"
          @change=${this.setHideCompleted}
          ?checked=${this.hideCompleted}
        />
        Hide completed
      </label>
    `;
  }

  toggleCompleted(item) {
    item.completed = !item.completed;
    this.requestUpdate();
  }

  setHideCompleted(e) {
    this.hideCompleted = e.target.checked;
  }

  get input() {
    return this.renderRoot?.querySelector('#newitem') ?? null;
  }

  addToDo() {
    if (this.input && this.input.value.trim() !== '') {
      this._listItems = [
        ...this._listItems,
        { text: this.input.value, completed: false },
      ];
      this.input.value = '';
    }
  }
}

customElements.define('my-element', MyElement);
