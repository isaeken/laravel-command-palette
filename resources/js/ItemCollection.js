import {search} from "./helpers";

export default class ItemCollection {
  items = [];

  getItems = (raw = false, query = undefined) => {
    if (raw) {
      return query != null ? search(this.items, query) : this.items;
    }

    let items = [];

    for (const item of this.items) {
      if (item.hasOwnProperty('type') && item.type === 'group') {
        items = [...items, ...item.items];
      } else {
        items.push(item);
      }
    }

    return query != null ? search(items, query) : items;
  };

  setItems = (items) => {
    this.items = items;
    return this;
  };
};