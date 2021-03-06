import React from 'react';
import Command from "./Command";

export default class Group extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      id: props?.id,
      name: props.name,
      description: props.description,
      commands: props.commands,
      loading: props.loading ?? false,
      disabled: props.disabled ?? false,
    };
  }

  static getDerivedStateFromProps(props, state) {
    if (props.commands !== state.commands) {
      return {
        commands: props.commands,
      };
    }

    if (props.loading !== state.loading) {
      return {
        loading: props.loading,
      };
    }

    if (props.disabled !== state.disabled) {
      return {
        disabled: props.disabled,
      };
    }

    return null;
  }

  render() {
    return (
      <div>
        <div className="x-pt-2 x-pb-1 x-px-4">
          <div className="x-text-sm x-font-semibold">
            {this.state.name}
          </div>
          {this.state.description != null && this.state.description.length > 0 ? (
            <div className="x-text-xs">
              {this.state.description}
            </div>
          ) : null}
        </div>
        <div>
          {this.state.commands.map((command, index) => {
            return (
              <Command
                key={'command.group.' + this.state.id + '.' + index}
                command={command}
                loading={this.state.loading}
                disabled={this.state.disabled}
                getSelectedCommand={this.props.getSelectedCommand}
                setSelectedCommand={this.props.setSelectedCommand}
                executeCommand={this.props.executeCommand}
              />
            );
          })}
        </div>
      </div>
    );
  }
}
