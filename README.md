### Elevator Emulator

## Overview

This is a simple Building Elevator Usage Emulator. 
Can be configurate elevators, number of floors end sequencies of use.
The application return a report of the usage of each elevator each minute.

## Built With

- Symfony 5.2.5
- JQuery 3.2.1
- popper 1.12.9
- Bootstrap 4.0.0
- jquery-dataTables 1.10.24

## Getting Started

This is a demo application of the the main library of the project, The library is located  in the folder `Acme/ControlElevatorBundle`.

#### About the software.

The  snapshot information of the elevators, is taken before the sequences are launched. 
In this version the elevator's name not is not coustomizable.



### Configuration

The file `src/Setting.php` is a example of the configuration data, is file has the only purpose of show all the library configuration. If you need another type of data loading, you must deploy the method and convert you data in the format required.

### Usage

Import the classes and create a intance of TimerThread, for create a array of Sequence instances, can use the factory `Sequence::factorySequencies($data);`. The requied parameters in constructor are number de elevators, number of floors in building and array of sequences.

```php
use Acme\ControlElevatorBundle\Controller\TimerThread;
use Acme\ControlElevatorBundle\Model\Sequence;
// imported classes

        $sequences = Sequence::factorySequencies(Setting::$SEQUENCES);
        $thread = new TimerThread(Setting::$ELEVATORS, Setting::$FLOORS, $sequences);

```
To get the report, call `run()` method with the first parameter the initial hour military format ( 09:05 -> 950) and the final hour ni the same format. 

```php
$report = $thread->run(900, 1530);
```
## Roadmap
See the [open issues](https://github.com/othneildrew/Best-README-Template/issues) for a list of proposed features (and known issues).

## Contact

Maximilano Fernández thebluemax13@gmail.com
