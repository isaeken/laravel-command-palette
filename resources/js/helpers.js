export function search(items, query) {
  if (query != null && query.length > 1) {
    items = items
      .map((item) => {
        if (item.hasOwnProperty('type') && item.type === 'group') {
          item.items = search(item.items, query);
        }

        return item;
      })
      .filter((item) => {
        if (item.hasOwnProperty('text') && item.text.length > 0) {
          return item.text.toLowerCase().indexOf(query) > -1;
        }

        return true;
      });
  }

  return items;
}

export const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));
