import React from 'react';
import DynamicIcon from "../DynamicIcon";

export default class Command extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      command: props.command,
    };
  }

  static getDerivedStateFromProps(props, state) {
    if (props.selected !== state.selected) {
      return {
        selected: props.selected,
      };
    }

    if (props.command !== state.command) {
      return {
        command: props.command,
      };
    }

    return null;
  }

  checkIsSelected = () => {
    if (this.props.getSelectedCommand instanceof Function) {
      return this.props.getSelectedCommand()?.id === this.state.command.id;
    }

    return false;
  };

  selectCurrentCommand = () => {
    if (this.props.setSelectedCommand instanceof Function) {
      this.props.setSelectedCommand(this.state.command);
    }
  };

  render() {
    return (
      <div
        onMouseEnter={this.selectCurrentCommand}
        onClick={() => {
          this.props.executeCommand(this.state.command);
        }}
        className={
          this.checkIsSelected() ?
            "x-select-none x-cursor-pointer x-text-sm x-px-4 x-py-4 x-block x-m-2 x-rounded-lg x-bg-indigo-600 x-text-white" :
            "x-select-none x-cursor-pointer x-text-sm x-px-4 x-py-4 x-block x-m-2 x-rounded-lg x-bg-white x-bg-opacity-20"
        }>
        <div className="x-flex x-items-center x-space-x-2">
          {this.state.command.icon != null ? (
            <div className="x-mr-2">
              <DynamicIcon iconName={this.state.command.icon}/>
            </div>
          ) : null}
          <div className="x-w-full">
            <div className="x-font-semibold">
              {this.state.command.name}
            </div>

            {this.state.description != null && this.state.description.length > 0 ? (
              <div className="x-text-xs">
                {this.state.command.description}
              </div>
            ) : null}
          </div>
          <div className="x-text-right x-w-24 text-xs x-opacity-50">
            Jump to...
          </div>
        </div>
      </div>
    );
  }
}
