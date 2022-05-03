import * as api from "./api";
import {sleep} from "./helpers";

export class CommandExecution {
  constructor(command) {
    this.command = command;
    this.executions = [
      {
        name: 'redirect',
        callback: (data) => {
          if (data.hasOwnProperty('url')) {
            window.location.href = data.url;
          } else {
            window.location.href = data;
          }
        },
      },
      {
        name: 'alert',
        callback: (data) => {
          alert(data);
        },
      },
      {
        name: 'log',
        callback: (data) => {
          console.log(data);
        },
      },
      {
        name: ['sleep', 'delay'],
        callback: async (data) => {
          await sleep(data);
        },
      },
    ];
  }

  extend = (name, callback) => {
    this.executions.push({
      name: name,
      callback: callback,
    });
  };

  execute = async (name, data) => {
    const executionIndex = this.executions.findIndex((object) => {
      if (object.name instanceof Array) {
        return object.name.includes(name);
      }

      return object.name === name;
    });

    if (executionIndex > -1) {
      await this.executions[executionIndex].callback(data);
    }
  };

  run() {
    api.execute(this.command.id).then(async (executions) => {
      for await (const execution of executions) {
        await this.execute(execution.type, execution.data);
      }
    });
  }
}
