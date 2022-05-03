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

export const isUrl = (string) => {
  const pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
    '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator

  return !!pattern.test(string);
}

export const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));
