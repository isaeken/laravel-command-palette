import axios from 'axios';

export const endpoint = '/_command-palette/api';

export const data = async () => {
  return (await axios.get(`${endpoint}/data`)).data;
};

export const commands = async () => {
  return (await axios.get(`${endpoint}/commands`)).data;
};

export const execute = async (commandId, args = null) => {
  return (await axios.post(`${endpoint}/commands/${commandId}`, args ?? {})).data;
};
