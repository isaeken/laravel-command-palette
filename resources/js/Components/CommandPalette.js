import React, {createRef} from 'react';
import {Backdrop, Modal} from "@mui/material";
import Group from "./Items/Group";
import ItemCollection from "../ItemCollection";
import * as api from "../api";
import Command from "./Items/Command";

export default class CommandPalette extends React.Component {
  input = createRef();
  items = new ItemCollection();

  constructor(props) {
    super(props);

    this.state = {
      open: false,
      placeholder: props.placeholder ?? 'Search or jump to...',
      value: '',
      tips: {
        enabled: true,
        texts: [],
      },
      data: {
        commands: [],
        grouped: {},
        groups: {},
      },
      selected: -1,
    };
  }

  componentDidMount() {
    api.commands().then((commands) => {
      this.setState({
        data: commands,
        loading: false,
      });
    });

    document.onkeydown = (event) => {
      if (event.ctrlKey && event.code === "KeyK") {
        this.open();
        event.preventDefault();
        return true;
      } else if (event.code === "Escape") {
        this.close();
        event.preventDefault();
        return true;
      } else if (event.code === "Enter") {
        this.executeCommand();
      } else if (event.code === "ArrowDown") {
        const current = this.getSelectedCommand();
        let nextCommand = current != null ? this.getNextCommand(current) : null;

        if (current !== null && nextCommand !== null) {
          this.setSelectedCommand(nextCommand);
          this.input.current.blur();
        } else if (current == null) {
          this.setSelectedCommand(this.state.data.commands[0]);
          this.input.current.blur();
        }
      } else if (event.code === "ArrowUp") {
        const current = this.getSelectedCommand();
        let previousCommand = current != null ? this.getPreviousCommand(current) : null;

        if (current !== null && previousCommand !== null) {
          this.setSelectedCommand(previousCommand);
        } else {
          this.setState({selected: this.state.selected - 1});
          this.input.current.focus();
        }
      } else {
        // ...
      }
    };

    this.autoFocus();
  }

  open = () => {
    this.setState({open: true});
    setTimeout(() => {
      this.autoFocus();
    }, 150);
  };

  close = () => {
    this.setState({open: false});
  };

  getSelectedCommand = () => {
    for (const item of this.state.data.commands) {
      if (item.id === this.state.selected) {
        return item;
      }
    }

    return null;
  };

  setSelectedCommand = (command) => {
    this.setState({selected: command.id});
  };

  getPreviousCommand = (command) => {
    const currentIndex = this.state.data.commands.findIndex((object) => object?.id === command?.id);
    const commands = this.state.data.commands;

    if (commands.hasOwnProperty(currentIndex - 1)) {
      return commands[currentIndex - 1];
    }

    return null;
  };

  getNextCommand = (command) => {
    const currentIndex = this.state.data.commands.findIndex((object) => object?.id === command?.id);
    const commands = this.state.data.commands;

    if (commands.hasOwnProperty(currentIndex + 1)) {
      return commands[currentIndex + 1];
    }

    return null;
  };

  executeCommand = (command) => {
    if (command == null) {
      const current = this.getSelectedCommand();
      if (current != null) {
        this.executeCommand(current);
      }

      return;
    }

    console.log('executed', command)
  };

  renderTips = () => {
    if (this.state.tips.enabled) {
      return (
        <div className="x-w-full x-pt-4 x-pb-2 x-px-3 x-text-sm x-tracking-wide x-box-border">
          <b className="x-mr-1">Tip:</b>
          <span>just testing...</span>
        </div>
      );
    }
  };

  renderItems = () => {
    return Object.keys(this.state.data.grouped).map((groupKey) => {
      const commands = this.state.data.grouped[groupKey];

      if (this.state.data.groups.hasOwnProperty(groupKey)) {
        const group = this.state.data.groups[groupKey];
        const groupName = group instanceof Object ? group.name : group;
        const groupDescription = group instanceof Object ? group?.description : null;

        return (
          <Group
            key={'command.group.' + groupKey}
            id={groupKey}
            name={groupName}
            description={groupDescription}
            commands={commands}
            getSelectedCommand={this.getSelectedCommand}
            setSelectedCommand={this.setSelectedCommand}
            executeCommand={this.executeCommand}
          />
        );
      }

      return commands.map((command, index) => {
        return (
          <Command
            key={'command.without.group.' + index}
            command={command}
            getSelectedCommand={this.getSelectedCommand}
            setSelectedCommand={this.setSelectedCommand}
            executeCommand={this.executeCommand}
          />
        );
      });
    });
  };

  autoFocus = () => {
    if (this.state.selected === -1 && this.input.current != null) {
      this.input.current.focus();
    }
  };

  render() {
    return (
      <div style={{
        zIndex: 9999999,
      }}>
        <Modal
          open={this.state.open}
          onClose={this.close}
          aria-labelledby="modal-modal-title"
          aria-describedby="modal-modal-description"
        >
          <div
            className="x-font-roboto x-shadow-2xl x-fixed x-w-full x-max-w-2xl x-top-1/2 x-left-1/2 x-transform -x-translate-x-1/2 -x-translate-y-1/2 x-bg-white x-bg-opacity-75 x-backdrop-blur-md x-rounded-xl x-outline-none">
            <input
              ref={this.input}
              placeholder={this.state.placeholder}
              value={this.state.value}
              onChange={(event) => {
                this.setState({
                  value: event.target.value,
                });
              }}
              className="x-font-roboto x-text-xl x-box-border x-py-4 x-px-4 x-block x-outline-none x-border-0 x-border-b x-border-gray-300 x-rounded-t-xl x-bg-transparent x-w-full"/>
            <div className="x-w-full x-max-h-96 x-overflow-y-auto">
              {this.renderTips()}
              <div className="x-divide-y">
                {this.renderItems()}
              </div>
            </div>
          </div>
        </Modal>
        <Backdrop
          sx={{color: '#fff', zIndex: (theme) => theme.zIndex.drawer + 1}}
          open={this.state.open}
          onClick={this.close}
        >
        </Backdrop>
      </div>
    );
  }
}
