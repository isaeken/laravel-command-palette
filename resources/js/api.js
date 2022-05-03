import axios from 'axios';

export const endpoint = '/_command-palette/api';

export const commands = async () => {
  return (await axios.get(`${endpoint}/commands`)).data;
};

export const execute = async (commandId) => {
  return (await axios.post(`${endpoint}/commands/${commandId}`, {})).data;
};
