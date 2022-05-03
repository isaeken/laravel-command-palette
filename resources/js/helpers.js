export function search(items, query) {
  if (query != null && query.length > 1) {
    items = items
      .filter((item) => {
        if (item.hasOwnProperty('name') && item.name.length > 0) {
          return item.name.toLowerCase().indexOf(query) > -1;
        }

        return true;
      });
  }

  return items;
}

export const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));
